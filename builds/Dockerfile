FROM php:7.4-cli-alpine

RUN $(php -r '$extensionInstalled = array_map("strtolower", \get_loaded_extensions(false));$requiredExtensions = ["zlib", "json", "json", "json", "json", "json", "json", "fileinfo", "fileinfo", "pcre"];$extensionsToInstall = array_diff($requiredExtensions, $extensionInstalled);if ([] !== $extensionsToInstall) {echo \sprintf("docker-php-ext-install %s", implode(" ", $extensionsToInstall));}echo "echo \"No extensions\"";')

COPY spreadsheet /spreadsheet

ENTRYPOINT ["/spreadsheet"]
