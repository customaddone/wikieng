[
  {
    "name": "app",
    "image": "183344260146.dkr.ecr.ap-northeast-1.amazonaws.com/app:latest",
    "cpu": 200,
    "memory": null,
    "memoryReservation": 600,
    "essential": true,
    "command": ["php", "artisan", "migrate"],
    "logConfiguration": {
      "logDriver": "awslogs",
      "options": {
        "awslogs-group": "migration",
        "awslogs-region": "ap-northeast-1",
        "awslogs-stream-prefix": "app-migration"
      }
    }
  }
]
