# CAT201 Assignment 1
> **MEMBERS**

**1.** `Jacky Chung Sze Yung`

**No. Matric -** `163326`

**2.** `Axler Chin Shun Yuan`

**No. Matric -** `162331`

**3.** `Andrew Tee Wei Xiong`

**No. Matric -** `164761`

**4.** `Teh Hong Jun`
**No. Matric -** `164723`

> GROUP NUMBER

**GROUP 22**

> VIDEO PRESENTATION

https://youtu.be/BLD4o91EzPA

> INTRODUCTION

We are from **GROUP 22**. This is our first website we ever made by using  `HTML`, `CSS`, `Java` and `PHP` programming language. Our project is called **Convert4U**. It is a website that help users to convert their pdf files to text files, and text files to pdf files, or even all in one !

> FEATURES
- Friendly user interface
- Supported ALL IN ONE convertion between PDF and TXT files
- Supported uploading multiple files
- Supported downloading multiple files and archieve it into a `.zip` file

## !! Before Installment !!
To begin working on the assignment, clone the repository to your local machine. Follow the instructions in [**CLONE_REPO.md**](CLONE_REPO.md) for a detailed guide on how to clone the repository.

> ## Run Our Server With Docker
### Step 1: Open Docker

Open your **Docker**. Make sure you **log into your Docker account**.

### Step 2: Open WSL

Open your **WSL**.

### Step 3: Set the Correct Directory in WSL

Make sure your WSL directory is pointed to the **directory of the parent file**.

For example, in this Github repository, the parent file is `CAT201-Assignment-1/Apache`, then you should set your current directory by running this **command** in your **WSL**:
```bash
cd <your-path>/CAT201-Assignment-1/Apache
```
Replace `<your-path>` with **your path that includes the parent file**.

This is an example shows how the directory looks like:
```bash
root@Axler-Laptop2:/mnt/d/Coding/CAT201/CAT201-Assignment-1#
```

### Step 4: Run Command In WSL

It is better to ensure that your **Docker doesn't include any containers** to avoid the conflicts.

Then, run this **command** in your **WSL**:
```bash
docker-compose up --build
```

### Step 5: Done
If everything is correct, it will show your `Network apache_default` and `Container apache-sercice` is created:
```bash
✔ Network apache_default    Created                                                                                                   0.1s 
✔ Container apache-service  Created                                                                                                   0.9s 
Attaching to apache-service
apache-service  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.20.0.2. Set the 'ServerName' directive globally to suppress this message
apache-service  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.20.0.2. Set the 'ServerName' directive globally to suppress this message
apache-service  | [Sun Dec 10 09:11:35.128277 2023] [mpm_prefork:notice] [pid 1] AH00163: Apache/2.4.57 (Debian) PHP/8.3.0 configured -- resuming normal operations
apache-service  | [Sun Dec 10 09:11:35.128319 2023] [core:notice] [pid 1] AH00094: Command line: 'apache2 -D FOREGROUND'
```
