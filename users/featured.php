<?php header('Content-Type: application/json');?>
{
  "status": true,
  "page": {
    "total": 123,
    "offset": 0,
    "limit": 20
  },
  "users": [
    {
                "user_id" : "1",
                "username" : "user",
                "full_url" : "https://vidd.la/user",
                "avatar" : "http://vidd.la/cdn/soonv2/team/darius.jpg",
                "avatar_url" : "http://vidd.la/cdn/soonv2/team/darius.jpg."
                },
                    {
                "user_id" : "2",
                "username" : "user2",
                "full_url" : "https://vidd.la/user",
                "avatar" : "http://vidd.la/cdn/soonv2/team/darius.jpg",
                "avatar_url" : "http://vidd.la/cdn/soonv2/team/darius.jpg."
                }
  ]
}