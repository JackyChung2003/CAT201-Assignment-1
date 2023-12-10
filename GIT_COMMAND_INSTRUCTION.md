# Introduction to Git - Quick Reference

## Checking Status

Check the status of your repository:

```bash
git status
```

## Staging Files

Add specific files to the staging area:

```bash
git add file.cpp
```

Add all files in the project folder:

```bash
git add .
```

```bash
git add --all
```

## Making Commits

Commit staged changes with a message:

```bash
git commit -m "Commit message"
```

## Commit History

View commit history:

```bash
git log
```

To go back to a previous state of your project code that you committed, you can use the following command:

```bash
git checkout <commit-hash>
```

## Branch

Creating a New Branch: _(**Note**: No need to do this if you've already created all branches)_

```bash
git branch <new-branch-name>
```

Switching to a New Branch:

```bash
git checkout <new-branch-name>
```

List all branches:

```bash
git branch
```

## Merging Branches

Merge changes from a different branch:

```bash
git merge <branch-name>
```

## Important Steps/Routine Check

1. **Check Your Branch:**

   - Confirm you are on your own branch by using `git branch`.

2. **Status Check:**

   - After coding, use `git status` to review your changes.

3. **Stage Changes:**

   - Move your changes to the staging area using `git add <file-name>`.

4. **Recheck Status:**

   - Optionally, reconfirm changes with `git status`.

5. **Commit Changes:**

   - Commit your code with a meaningful message using `git commit -m "commit message"`. Include important notes for future reference.

6. **Recheck Status:**

   - Double-check the status to ensure everything is in order using `git status`.

7. **Push to Your Branch:**

   - Use `git push` to push changes to your own branch.

8. **Switch to Testing Branch:**

   - If confident, switch to the `testing` branch with `git checkout testing`.

9. **Pull Latest Changes:**

   - Pull the latest updates from the branch using `git pull`.

10. **Merge Branches:**

    - Merge your own branch with the `testing` branch.

11. **Recheck Status:**

    - Verify the status after merging with `git status`.

12. **Push to Testing:**

    - Push the merged code to the `testing` branch using `git push`.

13. **Return to Your Branch:**
    - Navigate back to your own branch for other tasks.
