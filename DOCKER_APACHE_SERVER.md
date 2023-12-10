# CAT201-Assignment-1

To ensure Docker can run on your computer, follow the instructions below. Here are some quick references:

- [**Amazing video about how to install Apache web server in Docker container**](https://www.youtube.com/watch?v=mO93QRna8ws&ab_channel=Abstractprogrammer)
- [**Apache HTTP Server Project Documentation**](https://hub.docker.com/_/httpd)

## Step 1: Download Ubuntu on Windows 11

Refer to this [link](https://ubuntu.com/tutorials/install-ubuntu-on-wsl2-on-windows-11-with-gui-support#1-overview) to install Ubuntu.

## Step 2: Download Docker Desktop

## Step 3: Download Apache (Should be running in Ubuntu)

```bash
sudo apt install apache2
```

## Step 4: Make sure you are on the right directory

Ensure your terminal starts with something like:

```bash
PS D:\CAT201\CAT201-Assignment-1\Apache>
```

## Step 5: Run Apache in Docker

```bash
docker run -dit --name cat-201-apache-app -p 8081:80 -v ${PWD}:/usr/local/apache2/htdocs/ httpd:2.4
```

Note: I'm hosting it on port 8081, but feel free to change it to 8080:80.

## Step 6: Build the Docker Image

```bash
docker build -t apache-image:1.0 .
```

I'm naming my image as apache-image with Tag 1.0.

## Step 7: Run the Docker Image

```bash
docker run -dit --name apache-container -p 8081:80 apache-image:1.0
```
