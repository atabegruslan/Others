- Enable case sensitivity on the folder level: https://www.windowscentral.com/how-enable-ntfs-treat-folders-case-sensitive-windows-10
- Getting into a Docker container's shell: https://github.com/vercel/hyper/issues/2888
- Running bash files on Windows Gitbash, newline incompatibility fix: https://stackoverflow.com/a/11929475 
  - Windows uses CRLF, Linux uses LF
  - Convert all newlines in 1 file `dos2unix <file>` 
  - Recursively convert all newlines: `find . -type f -print0 | xargs -0 dos2unix`
  - https://github.com/eslint/eslint/blob/main/docs/rules/linebreak-style.md
- Add `zip` to "git bash" on Windows: https://stackoverflow.com/a/38783744