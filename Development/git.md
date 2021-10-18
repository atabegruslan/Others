# Git moves and solutions to common issues

## Multiple GitHub account issues
    
- By forcing correct credential: `git remote set-url origin "https://USERNAME@github.com/USERNAME/REPO.git"`
- By clearing git credentials on your local machine: https://stackoverflow.com/questions/47465644/github-remote-permission-denied

## Auth
- https://docs.github.com/en/github/authenticating-to-github/connecting-to-github-with-ssh
- https://github.blog/2020-12-15-token-authentication-requirements-for-git-operations/
- https://www.theserverside.com/blog/Coffee-Talk-Java-News-Stories-and-Opinions/Fix-GitHubs-support-for-password-authentication-was-removed-error
- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/git/git_ssh_key_renew.pdf

### Commit with different credentials

```
git -c user.name="{USERNAME}" -c user.email={EMAIL} commit -m "commit message" --author="{USERNAME} <{EMAIL}>"
git remote add origin https://github.com/{USERNAME}/{REPO}.git
```
- https://penandpants.com/2013/02/07/git-pushing-to-a-remote-branch-with-a-different-name/
- https://www.git-tower.com/learn/git/faq/change-author-name-email/
- https://alvinalexander.com/git/git-show-change-username-email-address/

## Git submodule

In the dependant repo: `git submodule add -b develop https://username:password@github.com/account/needed-project dest-path/needed-project`
In the terminal: `git submodule init && git submodule update`

## Undo 

- https://www.youtube.com/watch?v=DSeyfEgoPOM
- https://www.atlassian.com/git/tutorials/resetting-checking-out-and-reverting
- https://medium0.com/mindorks/use-of-git-reset-git-revert-git-checkout-squash-commit-2b721ca2d2d3

### Via Revert

Revert a specific commit: `git revert {commit hash ID}`

#### Revert previously pushed commit (locally, ie: Undo previous commit):

`git checkout HEAD~1` (local go back 1), `git reset --hard origin/branchName`, `git checkout branchName` (make sure still on right local branch), `git pull` (make sure up to date)

#### Revert previously pushed commit (remotely):

`git log` get commit hash, `git revert xxx` or `git revert HEAD-1..HEAD` (go back 1), update commit message, `git push`

- https://git-scm.com/docs/git-revert#_examples
- https://stackoverflow.com/questions/1463340/how-to-revert-multiple-git-commits

### Via Reset

-  https://git-scm.com/docs/git-reset#_examples

#### Locally

Undo previous commit:

```
git reset --soft HEAD~1
# Make changes
git commit -c ORIG_HEAD # use previous commit & commit message
# Update commit message if you want
```

Undo `git add README.md`: `git reset README.md`

-  https://stackoverflow.com/questions/927358/how-do-i-undo-the-most-recent-local-commits-in-git

#### To Remote Repo

- `git reset $HEAD --hard` and then `git push -f`
- https://stackoverflow.com/questions/52823692/git-push-force-with-lease-vs-force

### Via Checkout

```
git checkout {commit hash} .
git commit -m"xxx"
```

- https://stackoverflow.com/questions/4114095/how-do-i-revert-a-git-repository-to-a-previous-commit
- https://stackoverflow.com/questions/7124486/what-to-do-with-commit-made-in-a-detached-head

### Via Patch

- https://www.codeblocq.com/2016/09/Create-patch-from-commit-with-git/#:~:text=1%20Method%201%3A%20git%20reset%20%2B%20git%20diff,apply%20your%20patch%20somewhere%20else%20or%20later%20on
- https://www.git-tower.com/learn/git/faq/create-and-apply-patch/
- https://www.specbee.com/blogs/how-create-and-apply-patch-git-diff-and-git-apply-commands-your-drupal-website

## Cherrypick

Applying a commit to a branch from another branch
```
git checkout {dest branch}
git cherry-pick {src commit SHA}
```
- https://www.atlassian.com/git/tutorials/cherry-pick

## Rebase

- https://git-scm.com/docs/git-rebase#_description

Don't rebase any commits that's been pushed to a remote repo

## Git Terminology

![](/Illustrations/Development/git/git_term.PNG)

- https://stackoverflow.com/questions/3689838/whats-the-difference-between-head-working-tree-and-index-in-git
- `HEAD~` vs `HEAD^`: https://stackoverflow.com/questions/2221658/whats-the-difference-between-head-and-head-in-git
- What BLOB means: https://matthew-brett.github.io/curious-git/git_object_types.html
- Tracking a branch means to match it to its remote counterpart and 'monitors' it: https://www.git-tower.com/learn/git/faq/track-remote-upstream-branch/

## Useful commands

- Change commit message: `git commit --amend -m"correction to previous message"` 
	- https://linuxize.com/post/change-git-commit-message/
- Rename branch: `git branch -m oldName newName`
	- If currently on `oldName` branch: `git branch -m newName`
- Checkout remote branch: `git fetch`, `git checkout remoteBranchName`
	- `git pull` only pull branches that you are locally tracking, not the branches that exists on remote but not on your local.
- Git pull and force overwrite (Edit file but dont commit nor push): `git fetch --all`, `git reset --hard origin/branchName`
- Archive: `git archive --format zip --output ../fileName.zip branchName`
- Delete both local and remote branch at once: `git push origin --delete branchName`
- Remove local untracked files: 
	- `git clean` No going back
	- `git clean -n` Show what would be cleaned out if clean command is run
	- `-f` Force. `-d` Remove directories. `-X Remove ignored files`
- Clone all remote branches: `git fetch`, `git branch -a`
	- You might see a branch that exists remotely but not locally eg "missingBranch", `git checkout origin/missingBranch`, enter detatched HEAD state, `git checkout -b missingBranch origin/missingBranch`
- Make existing branch track remote branch: `git branch -u origin/remoteTargetBranch`, sync the local branch that u r on to the remoteTargetBranch, then u can use `git pull` or `git push`
- Pull pull-requests (Github): https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/git/pull_github_pull_requests.pdf
- Give files executable permissions: `git update-index --chmod=+x xxx.sh`
- Remove files: https://stackoverflow.com/questions/38983153/git-ignore-env-files-not-working
- Configure display: 

![](/Illustrations/Development/git/git_config_display.PNG)

- https://www.youtube.com/playlist?list=PLdMKkri2rs0tIcDT0sAY4OYD3xRci8u9p
- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/git/git.txt

## GitBook

![](/Illustrations/Development/git/turning_folder_into_gitbook_directory.PNG)

https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/git/gitbook_win/

## Working with private Git repos may only work with SSH

- https://stackoverflow.com/questions/25947059/git-clone-repository-not-found
- https://www.a2hosting.com/kb/developer-corner/version-control-systems1/403-forbidden-error-message-when-you-try-to-push-to-a-github-repository

