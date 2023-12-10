# CAT201-Assignment-1

## **[Get Started With Github Command]**
### Step 1: Clone the Repository

To begin working on the assignment, clone the repository to your local machine. Follow the instructions in [**CLONE_REPO.md**](CLONE_REPO.md) for a detailed guide on how to clone the repository.

### Step 2: Familiarize Yourself with Git Commands

Before you start making changes, it's crucial to understand basic Git commands. Refer to [**GIT_COMMAND_INSTRUCTION.md**](GIT_COMMAND_INSTRUCTION.md) for a comprehensive guide. Below are some essential commands for quick reference:

```bash
# Check the current branch
git branch

# Switch to a different branch
git checkout branch-name

# Check the status of your working directory
git status

# Add changes to the staging area
git add file1 file2 ...    # Add specific files
git add --all              # Add all changes

# Commit the staged changes
git commit -m "Your commit message here"

# Push the code
git push

# Merge branches (Ensure you only merge your branch into 'testing' to avoid issues)
git checkout testing
git merge branch-name
```

### Step 3: Set up Linux Apache webserver

Can go and check the [**How to install Apache web server in a Docker container**](DOCKER_APACHE_SERVER.md).

## **[Run Our Server Within Docker]**

### Step 1: Open Docker

Open your **Docker**. Make sure you log into your Docker account.

### Step 2: Open Ubuntu

Open your **Ubuntu**.

### Step 3: Set the Correct Directory

Make sure you are in the **directory of the parent file**.

For example, in this Github repository, the parent file is `CAT201-Assignment-1`, then you should set your current directory by running this **command** in your **Ubuntu**:
```bash
cd <your-path>/CAT201-Assignment-1
```
Replace `<your-path>` with **your path that includes the parent file**.

### Step 4: Run Command In Ubuntu

Run this **command** in your **Ubuntu**:
```bash
sudo ./start.sh
```
Make sure your **Docker doesn't have any containers** !!
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
