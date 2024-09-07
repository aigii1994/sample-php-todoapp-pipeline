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
  // Check php & phpunit
    stage('verify installations') {
      steps {
        sh '''
          php -v
          phpunit --version
        '''
      }
    }
  // Run Tests
    stage('run tests') {
      steps { 
        catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {
        sh 'phpunit --bootstrap src/autoload.php tests'
      } }
    }
  // Run Tests in test box
    stage ('run tests with TestDox') {
      steps {
        catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {
        sh 'phpunit --bootstrap src/autoload.php --testdox tests' 
        }
      }
    }
  // VAlidate against JUnit results 
    stage ('run tests with JUnit results') {
      steps {
        catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {
        sh 'phpunit --bootstrap src/autoload.php --log-junit target/junit-results.xml tests'
      } 
      }
      post {
        always {
          //push it to remote repo if exist
          junit testResults: 'target/*.xml'
        }
      }
    }
  }
}

