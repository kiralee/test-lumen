pipeline {
    agent any
    stages {
        stage('Building') {
            steps {
                sh 'php --version'
                sh 'sudo docker exec container_php_fpm composer install'
                sh 'sudo docker exec container_php_fpm composer --version'
            }
        }
        stage('Testing') {
            steps {
                sh 'sudo docker exec container_php_fpm compose test'
            }
        }
        stage('Deploy') {
            steps {
                echo "Deployed"
            }
        }
    }
}