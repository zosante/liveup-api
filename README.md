## About LiveUp

API that provides the logic for the liveup-app

## Setup
The app is dockerized. Simply do the following: 

- `sh dockerizer.sh` or
- `bash dockerizer.sh`

or run from the terminal run:

- `docker-compose build && docker-compose up -d --remove-orphans`

Then navigate to `localhost:8070`

## Continued development
### Branching
Branch out from the main `master` branch with prefix e.g `feature/`, `bugfix/` and you'll have something like: `feature/add-to-readme`

### Interaction usage
Simply exec a terminal to interact with the docker container using

- `docker-compose exec bash` or
- `docker-compose exec sh` or

> PS: These commands works on Unix systems only.
