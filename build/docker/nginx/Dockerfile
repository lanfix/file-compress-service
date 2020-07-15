FROM nginx:1.17.8

ARG USER_ID
ARG GROUP_ID

RUN groupadd -g "$GROUP_ID" project
RUN useradd -l -u "${USER_ID}" -g project project
RUN install -d -m 0755 -o project -g project /home/project

WORKDIR /var/www
