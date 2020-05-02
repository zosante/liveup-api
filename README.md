## About LiveUp

API that provides the logic for the liveup-app

## Setup

Clone the repository with 
`git clone https://github.com/theliveup/liveup-api.git`

Next, since the app is is dockerized. Simply do the following: 

- `sh dockerizer.sh` or `sh dockerizer.sh --reset_migrations`
- `bash dockerizer.sh` or `bash dockerizer.sh --reset_migrations`

(All migrations and Some specific seeders are run also to give you something to work on)

Or run from the terminal run:

- `docker-compose build && docker-compose up -d --remove-orphans`

Then navigate to `localhost:8070/api`

## Swagger doc (for API consumers)

Find `swagger.json` file in the root of the project's directory and visit: https://editor.swagger.io/

#### Import from file
- Click File -> Import File
- Select `swagger.json` in the project's root directory
- Click "Open"

#### Import from URL
- Click File -> Import Url
- Paste this url: https://raw.githubusercontent.com/theliveup/liveup-api/master/swagger.json
- Click "OK"

Now you can use the Swagger doc to test request to the end points.

## Continued development
### Branching
Branch out from the main `master` branch with prefix e.g `feature/`, `bugfix/` and you'll have something like: `feature/add-to-readme`

### Interaction usage
Simply exec a terminal to interact with the docker container using

- `docker-compose exec app bash` or
- `docker-compose exec appi sh`

> PS: These commands works on Unix systems only.
