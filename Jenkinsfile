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
        catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {
        sh 'phpunit --bootstrap src/autoload.php tests'
      } }
    }
    stage ('run tests with TestDox') {
      steps {
        catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {
        sh 'phpunit --bootstrap src/autoload.php --testdox tests' 
        }
      }
    }
    stage ('run tests with JUnit results') {
      steps {
        catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {
        sh 'phpunit --bootstrap src/autoload.php --log-junit target/junit-results.xml tests'
      } 
      }
      post {
        always {
          junit testResults: 'target/*.xml'
        }
      }
    }
  }
}

