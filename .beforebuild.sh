rm -rf .git &&
git clone ${PROJECT_REPO} temp &&
find temp -maxdepth 1 -mindepth 1 -print0 | xargs -0 -I {} mv {} . &&
rm -rf temp  
ddev config --project-type=$PROJECT_TYPE  





