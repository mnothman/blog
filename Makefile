# Variables
DOCKER_IMAGE_NAME := blog
DOCKER_CONTAINER_NAME := blog-app-container
DOCKER_PORT := 8080

# Default target
.PHONY: all
all: build run

# Build the Docker image
.PHONY: build
build:
	@echo "Building Docker image..."
	docker build -t $(DOCKER_IMAGE_NAME) .

# Run the Docker container
.PHONY: run
run:
	@echo "Running Docker container..."
	docker run -d --name $(DOCKER_CONTAINER_NAME) -p $(DOCKER_PORT):80 $(DOCKER_IMAGE_NAME)

# Stop the Docker container
.PHONY: stop
stop:
	@echo "Stopping Docker container..."
	docker stop $(DOCKER_CONTAINER_NAME)

# Remove the Docker container
.PHONY: remove
remove: stop
	@echo "Removing Docker container..."
	docker rm $(DOCKER_CONTAINER_NAME)

# Clean up Docker images and containers
.PHONY: clean
clean: remove
	@echo "Removing Docker image..."
	docker rmi $(DOCKER_IMAGE_NAME)

# Show logs from the Docker container
.PHONY: logs
logs:
	@echo "Showing Docker container logs..."
	docker logs -f $(DOCKER_CONTAINER_NAME)

# Restart the Docker container
.PHONY: restart
restart: stop run
