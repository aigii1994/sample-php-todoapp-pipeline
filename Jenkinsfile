pipeline {
  agent any
  stages {
    stage('Build') {
     steps { 
     sh ''' 
      echo ${WORKSPACE}
      ls -ltrh
      scp ${WORKSPACE}/*.php root@webserver:/var/www/html
     '''
     }
}}}
