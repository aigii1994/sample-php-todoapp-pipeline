pipeline {
  agent any
stages {
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

     stage('Run PHP Linter') {
            steps {
                // Run PHP's built-in linter on all .php files
                script {
                    def phpFiles = sh(script: 'find . -name "*.php"', returnStdout: true).trim()
                    if (phpFiles) {
                        sh "echo ${phpFiles} | xargs php -l"
                    } else {
                        echo 'No PHP files found for linting'
                    }
                }
            }
        }
      
        stage('Run PHP_CodeSniffer') {
            steps {
                // Run PHP_CodeSniffer to check coding standards
                sh 'vendor/bin/phpcs --standard=PSR12 src/'
            }
        }

    stage('Deploy') {
     steps { 
     sh ''' 
      echo ${WORKSPACE}
      ls -ltrh
      scp ${WORKSPACE}/*.php root@webserver:/var/www/html
     '''
       }
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

