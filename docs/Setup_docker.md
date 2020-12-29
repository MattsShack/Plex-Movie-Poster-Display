# Docker Setup

<p>
<blockquote>
Usage of docker is a prototype.  User discretion is advised.
</blockquote>
<p>

## Information

This docker image is based on the latest [debian](https://hub.docker.com/_/debian) docker official image.

Once the image is built the size of the image is less than 250MB,  with a change to the base image this size could come down in the future.

The Dockerfile has been composed based on the instructions within the [Setup Local](Setup_local.md) file (_with a few liberations_).

Because this system creates a image based on a baseline state, we can take a few "shortcuts" to automate the process a bit.

Both nginx config files (with changes pre-applied) are included within this repo and are copied to the image during the `docker build` process.

Where a standard replace could be simply done, that process was used to keep true to the setup instructions.

Since this image is being built from within the code repo, a git clone was not required and the core application was copied directly into the image.

One advantage of moving to docker is that this system is now self contained and no longer requires a Raspberry Pi to run.  A Raspberry Pi can be now used just for display.

**Workarounds:**
Due to how docker is designed as a single service container; we have created a service wrapper to start multiple services when the image runs (nginx and php).

If you are familiar with docker these instructions should be very basic.

## Pre Requirements
Following the [Get Started with Docker](https://www.docker.com/get-started) would be a good start if you need to familiarize yourself with docker.
### Linux
- Installation instructions coming soon.
### Windows
- Installation of Docker Desktop for Windows can be found [here](https://download.docker.com/win/stable/Docker%20Desktop%20Installer.exe).
### macOS
- Installation of Docker Desktop for macOS can be found [here](https://download.docker.com/mac/stable/Docker.dmg).

## Build
    docker build -t {image Name} .

## Run
    docker run -d -p 80:80 -- {container Name} {image name}

## Docker Build (Simplified):
We have created a set of scripts to automate the creation and run process of the docker image.

### Python Script
    cd build
    py ./DockerSetup.py --port 80 --build --run
### PowerShell Script
    - Coming Soon

## Future Plans:
- To create a public docker image with latest build that can just be installed from docker hub.
- Add a "preConfig" script to allow for user to set the configuration before creating the image for quicker deployment.