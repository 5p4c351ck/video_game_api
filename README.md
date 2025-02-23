# video_game_api

Simple laravel backend assignment

This is a simple backend API for managing video games. It provides endpoints for **user registration**, **login/logout**, **game management**. It supports **admin** and **regular user** roles, with specific permissions for deleting and modifying games.
Please note that some setup choices, like having everything in the Dockerfile and using a simple PHP server, are for simplicity and ease of running the app. In a production environment, these steps would be handled differently.
I developed this on Debian Linux, but since it's a Docker image, it should work in any environment.

I assume Windows will be used, but the commands should work on Linux and macOS as well if Docker is installed.

### Greek Translation

Ενα απλό backend API για τη διαχείριση βιντεοπαιχνιδιών. Παρέχει endpoints για **εγγραφή χρήστη**, **σύνδεση/αποσύνδεση**, **διαχείριση παιχνιδιών**. Υποστηρίζει ρόλους **διαχειριστή** και **κανονικού χρήστη**, με συγκεκριμένα δικαιώματα για τη διαγραφή και τροποποίηση παιχνιδιών. Κάποιες επιλογές ρυθμίσεων, όπως η τοποθέτηση όλων των βημάτων στο Dockerfile και η χρήση ενός απλού PHP server, γίνονται για απλότητα και ευκολία εκτέλεσης της εφαρμογής. Σε ένα Production περιβάλλον, αυτά τα βήματα θα γίνονταν διαφορετικά.
Ανάπτυξα αυτή την εφαρμογή σε Debian Linux, αλλά καθώς είναι Docker image, θα πρέπει να λειτουργεί σε οποιοδήποτε περιβάλλον.

Υποθέτω ότι θα χρησιμοποιηθουν Windows, αλλά οι εντολές θα λειτουργούν και σε Linux και macOS εφόσον έχει εγκατασταθεί το Docker.

## Table of Contents
- [Installation](#installation)
- [Running with Docker](#running-with-docker)
- [API Testing](#postman-collection)

## Installation
Since the deliverable was asked as a git repository I assume git is installed
otherwise git can be downloaded from this link [Download Git](https://git-scm.com/downloads/win)
1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/5p4c351ck/video_game_api
   ```
   Navigate into the directory
   ```bash
   cd video_game_api
   ```



## Running with Docker

If Windows are used then Docker desktop needs to be installed.
follow the link [Install Docker Deskop](https://docs.docker.com/desktop/setup/install/windows-install/)

If Linux(Debian based) are used you can follow this link [Install Docker on debian](https://docs.docker.com/engine/install/debian/)

2. Build the Docker image:

   ```bash
   docker build -t video_games_api .
   ```
   Start a Docker container:
   You can run this commands in the shell in Linux or Powershell on Windows to run the container.

   ```bash
   docker run --name video_games_api_container -d -p 8000:8000 video_games_api
   ```

   
Otherwise, you can start it from Docker desktop from the images tab, screenshot bellow.
![Docker images](https://github.com/5p4c351ck/video_game_api/blob/main/screenshots/docker_desktop.png)
   
If you want to run it manually you need to set the port to 8000 like in the screenshot bellow.
![Docker container port](https://github.com/5p4c351ck/video_game_api/blob/main/screenshots/docker_desktop_port.png)




## API Testing

3. The API will be tested using Postman, so it needs to be installed as well if it's not installed already.
follow the link [Postman Installation](https://www.postman.com/downloads/)

The collection and environment files inside the Postman folder
need to be imported in Postman, click import on top left and import both.
![Import in Postman](https://github.com/5p4c351ck/video_game_api/blob/main/screenshots/Postman_import.png)

Finally you need to choose the Environment from the top right corner and also
add the following script in the Post-respose Scripts of the login requests highlighted in the image bellow.

```javascript
if (pm.response.code === 200) {
    var jsonResponse = pm.response.json();
    pm.environment.set("authToken", jsonResponse.token);
}
```
![Postman setup](https://github.com/5p4c351ck/video_game_api/blob/main/screenshots/Postman_setup.png)



You are now ready to test the API endpoints.







