pipeline {
    agent any
    stages {
        stage('Building') {
            steps {
                sh 'docker exec container_php_fpm composer install'
                sh 'docker exec container_php_fpm composer --version'
            }
        }
        stage('Testing') {
            steps {
                sh 'docker exec container_php_fpm composer test'
            }
            post {
                failure {
                    slackSend (color: "danger", message: "Testing failed")
                }
                success {
                    slackSend (color: "good", message: "Passed All testcases")
                }
            }
        }
        stage('Deploy to Stagging') {
            steps {
                echo "Deployed"
            }
        }
    }
    post {
        success {
            slackSend (color: "good", message: "Job: ${env.JOB_NAME} with buildnumber ${env.BUILD_NUMBER} was successful")
        }
        failure {
           slackSend (color: "danger", message: "Job: ${env.JOB_NAME} with buildnumber ${env.BUILD_NUMBER} was failed.")
        }
    }
}