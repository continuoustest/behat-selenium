#!/bin/bash

check()
{
	echo "Getting session id"
	session=`curl -X POST http://localhost:4444/wd/hub/session -d '{"desiredCapabilities":{"browserName":"chrome","platform":"MAC"}}'`

	if [ ! 0 -eq $? ]
	then
		return 1
	fi

	echo "Calling google"
	session=`echo $session | awk -F'"' '{print $6}'`
	result=`curl -X POST http://localhost:4444/wd/hub/session/$session/url -d '{"url":"http://www.google.com"}' | grep '"state":"success"'`

	if [ -z $result ]
	then
		echo "Result not expected"
		return 2
	fi
}

while true
do
	check
	r=$?

	if [ 0 -eq $r ]
	then
		echo "Selenium UP !"
		exit 0
	fi

	sleep 5
done
