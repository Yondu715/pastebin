FROM node:21.6-alpine AS base

RUN apk upgrade --update \
    && apk add --no-cache curl g++ python3 make git

ARG USER_ID=${USER_ID}
ARG USER_NAME=${USER_NAME}
ARG GROUP_ID=${GROUP_ID}
ARG GROUP_NAME=${GROUP_NAME}

ARG NODE_PROJECT_DIR=/opt/node-workdir/src
ARG NODE_BUILD_DIR=/opt/node-workdir/public
ARG NODE_WEBPACK_OUTPUT=./../public

ENV NODE_WEBPACK_OUTPUT=${NODE_WEBPACK_OUTPUT}
ENV PYTHON=/usr/bin/python
ENV NPM_CONFIG_PREFIX=/home/node/.npm-global
ENV SASS_BINARY_DIR=/home/node/sass-build
ENV npm_config_devdir=/home/node/gyp-tmp

RUN echo "Building for user: name=${USER_NAME} id=${USER_ID}"
RUN addgroup -g ${GROUP_ID} ${GROUP_NAME} || echo "Group exists"
RUN adduser -D -u ${USER_ID} -G ${GROUP_NAME} ${USER_NAME} || echo "User already in group"
RUN addgroup ${USER_NAME} node || echo "User already in node group"

RUN npm config set --global cache /home/node/.npm \
    && npm config set --global update-notifier false \
    && mkdir /home/node/.cache \
    && mkdir /opt/node-workdir \
    && mkdir -p ${NODE_PROJECT_DIR} \
    && mkdir -p ${NODE_BUILD_DIR} \
    && chown -R ${USER_ID}:${GROUP_ID} /opt/node-workdir/ \
    && chown -R ${USER_ID}:${GROUP_ID} /home/node/ \
    && chown -R ${USER_ID}:${GROUP_ID} ${NODE_PROJECT_DIR} \
    && chown -R ${USER_ID}:${GROUP_ID} ${NODE_BUILD_DIR}

USER ${USER_ID}
WORKDIR ${NODE_PROJECT_DIR}

# Сборка образа с фронтом
FROM base AS build

ARG BUILD_DIR=public
ARG SOURCE_DIR=src
ARG BUILD_NODE_CACHE_DIR=node_cache

COPY --from=base --chown=${USER_ID}:${GROUP_ID} /home/node/.cache /home/node/.cache
COPY --from=base --chown=${USER_ID}:${GROUP_ID} /opt/node-workdir /opt/node-workdir

VOLUME ["/home/node/"]

COPY --chown=${USER_ID}:${GROUP_ID} ${BUILD_DIR} ${NODE_BUILD_DIR}
COPY --chown=${USER_ID}:${GROUP_ID} ${SOURCE_DIR} ${NODE_PROJECT_DIR}
COPY --chown=${USER_ID}:${GROUP_ID} ${BUILD_NODE_CACHE_DIR} /home/node/

USER ${USER_ID}

WORKDIR ${NODE_PROJECT_DIR}

RUN npm ci
RUN npm run prod

# Сборка образа с фронтом
FROM base AS build-dev

ARG BUILD_DIR=public
ARG SOURCE_DIR=src

COPY --from=base --chown=${USER_ID}:${GROUP_ID} /opt/node-workdir /opt/node-workdir
COPY --from=base --chown=${USER_ID}:${GROUP_ID} /home/node/.cache /home/node/.cache

VOLUME ["/home/node/"]

COPY --chown=${USER_ID}:${GROUP_ID} ${SOURCE_DIR} ${NODE_PROJECT_DIR}
COPY --chown=${USER_ID}:${GROUP_ID} ${BUILD_DIR} ${NODE_BUILD_DIR}

USER ${USER_ID}

WORKDIR ${NODE_PROJECT_DIR}

RUN npm ci
RUN npm run dev

# Собранный фронт
FROM busybox AS prod-build

ARG NODE_BUILD_DIR=/opt/node-workdir/public

COPY --from=build ${NODE_BUILD_DIR} ${NODE_BUILD_DIR}
COPY --from=build ${NODE_BUILD_DIR}/mix-manifest.json ${NODE_BUILD_DIR}/mix-manifest.json
COPY --from=build /home/node/ /home/node/

WORKDIR ${NODE_PROJECT_DIR}
