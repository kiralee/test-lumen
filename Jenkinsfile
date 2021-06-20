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
        }
        stage('Deploy') {
            steps {
                echo "Deployed"
            }
        }
    }
    post {
        always{
            if(currentBuild.currentResult == "FAILURE"){
                slackSend color: "danger", message: "Job: ${env.JOB_NAME} with buildnumber ${env.BUILD_NUMBER} was failed"
            }else{
                slackSend color: "good", message: "Job: ${env.JOB_NAME} with buildnumber ${env.BUILD_NUMBER} was successful"
            }
        }
    }
}