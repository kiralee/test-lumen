pipeline {
    agent any
    stages {
        stage('Building') {
            steps {
                sh 'php --version'
                sh 'docker exec container_php_fpm composer install'
                sh 'docker exec container_php_fpm composer --version'
            }
        }
        stage('Testing') {
            steps {
                sh 'docker exec container_php_fpm compose test'
            }
        }
        stage('Deploy') {
            steps {
                echo "Deployed"
            }
        }
    }
}