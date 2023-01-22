FROM dart:latest

WORKDIR /dart-sass
RUN git clone https://github.com/sass/dart-sass.git . && \
    dart pub get
CMD dart ./bin/sass.dart --no-source-map /scss:/css && \
    dart ./bin/sass.dart --no-source-map --watch /scss:/css