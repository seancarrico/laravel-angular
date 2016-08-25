#!/usr/bin/env bash
TRAVIS_BRANCH=dev
function getJsonVal () {
    python -c "import json,sys;sys.stdout.write(json.dumps(json.load(sys.stdin)$1, sort_keys=True, indent=4))";
}

prodRE='master'

if [[ ${TRAVIS_BRANCH} =~ $prodRE ]]; then
    BUILD_ENV="prod"
else
    BUILD_ENV="test"
fi

echo ${BUILD_ENV}
echo ${TRAVIS_BRANCH}

git fetch --tags
git fetch --unshallow
BRANCH=`git rev-parse --abbrev-ref HEAD`

echo ${BRANCH}
