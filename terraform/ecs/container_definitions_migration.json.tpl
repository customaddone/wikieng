{
  "ipcMode": null,
  "executionRoleArn": null,
  "containerDefinitions": [
    {
      "dnsSearchDomains": null,
      "logConfiguration": {
        "logDriver": "awslogs",
        "secretOptions": null,
        "options": {
          "awslogs-group": "example",
          "awslogs-region": "ap-northeast-1",
          "awslogs-stream-prefix": "service"
        }
      },
      "entryPoint": null,
      "portMappings": [
        {
          "hostPort": 80,
          "protocol": "tcp",
          "containerPort": 80
        }
      ],
      "command": null,
      "linuxParameters": null,
      "cpu": 128,
      "environment": [],
      "resourceRequirements": null,
      "ulimits": null,
      "dnsServers": null,
      "mountPoints": [],
      "workingDirectory": null,
      "secrets": null,
      "dockerSecurityOptions": null,
      "memory": null,
      "memoryReservation": 256,
      "volumesFrom": [],
      "stopTimeout": null,
      "image": "183344260146.dkr.ecr.ap-northeast-1.amazonaws.com/example:latest",
      "startTimeout": null,
      "firelensConfiguration": null,
      "dependsOn": null,
      "disableNetworking": null,
      "interactive": null,
      "healthCheck": null,
      "essential": true,
      "links": [
        "app"
      ],
      "hostname": null,
      "extraHosts": null,
      "pseudoTerminal": null,
      "user": null,
      "readonlyRootFilesystem": null,
      "dockerLabels": null,
      "systemControls": null,
      "privileged": null,
      "name": "example"
    },
    {
      "dnsSearchDomains": null,
      "logConfiguration": {
        "logDriver": "awslogs",
        "secretOptions": null,
        "options": {
          "awslogs-group": "app",
          "awslogs-region": "ap-northeast-1",
          "awslogs-stream-prefix": "app"
        }
      },
      "entryPoint": null,
      "portMappings": [],
      "command": null,
      "linuxParameters": null,
      "cpu": 128,
      "environment": [
        {
          "name": "APP_KEY",
          "value": "base64:Rha6fhgYifnvVBnwm81FCal18ULvEgiMnqpLLwlvyKI="
        },
        {
          "name": "DB_CONNECTION",
          "value": "mysql"
        },
        {
          "name": "DB_DATABASE",
          "value": "wikieng"
        },
        {
          "name": "DB_HOST",
          "value": "example.cw5hony92ugy.ap-northeast-1.rds.amazonaws.com"
        },
        {
          "name": "DB_PASSWORD",
          "value": "topsecret"
        },
        {
          "name": "DB_USERNAME",
          "value": "root"
        }
      ],
      "resourceRequirements": null,
      "ulimits": null,
      "dnsServers": null,
      "mountPoints": [],
      "workingDirectory": null,
      "secrets": null,
      "dockerSecurityOptions": null,
      "memory": null,
      "memoryReservation": 256,
      "volumesFrom": [],
      "stopTimeout": null,
      "image": "183344260146.dkr.ecr.ap-northeast-1.amazonaws.com/app:latest",
      "startTimeout": null,
      "firelensConfiguration": null,
      "dependsOn": null,
      "disableNetworking": null,
      "interactive": null,
      "healthCheck": null,
      "essential": true,
      "links": null,
      "hostname": null,
      "extraHosts": null,
      "pseudoTerminal": null,
      "user": null,
      "readonlyRootFilesystem": null,
      "dockerLabels": null,
      "systemControls": null,
      "privileged": null,
      "name": "app"
    }
  ],
  "placementConstraints": [],
  "memory": null,
  "taskRoleArn": null,
  "compatibilities": [
    "EC2"
  ],
  "taskDefinitionArn": "arn:aws:ecs:ap-northeast-1:183344260146:task-definition/example:299",
  "family": "example",
  "requiresAttributes": [
    {
      "targetId": null,
      "targetType": null,
      "value": null,
      "name": "com.amazonaws.ecs.capability.logging-driver.awslogs"
    },
    {
      "targetId": null,
      "targetType": null,
      "value": null,
      "name": "com.amazonaws.ecs.capability.ecr-auth"
    },
    {
      "targetId": null,
      "targetType": null,
      "value": null,
      "name": "com.amazonaws.ecs.capability.docker-remote-api.1.19"
    },
    {
      "targetId": null,
      "targetType": null,
      "value": null,
      "name": "com.amazonaws.ecs.capability.docker-remote-api.1.21"
    }
  ],
  "pidMode": null,
  "requiresCompatibilities": [],
  "networkMode": null,
  "cpu": null,
  "revision": 299,
  "status": "ACTIVE",
  "inferenceAccelerators": null,
  "proxyConfiguration": null,
  "volumes": []
}
