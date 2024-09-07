pipeline {
  agent any
  stages {
     stage('Build') {
    publishOverSSH(
    configName: webserver
    transfers: [
        [sourceFiles: '*.php',remoteDirectory: '/var/www/html']
    ],
    execCommand: "ls -lrt && echo 'Hello from remote!'"
           )
     }
    stage('verify installations') {
      steps {
        sh '''
          php -v
          phpunit --version
        '''
      }
    }
    stage('run tests') {
      steps {
        sh 'phpunit --bootstrap src/autoload.php tests'
      }
    }
    stage ('run tests with TestDox') {
      steps {
        sh 'phpunit --bootstrap src/autoload.php --testdox tests'
      }
    }
    stage ('run tests with JUnit results') {
      steps {
        sh 'phpunit --bootstrap src/autoload.php --log-junit target/junit-results.xml tests'
      }
      post {
        always {
          junit testResults: 'target/*.xml'
        }
      }
    }
}
 }
