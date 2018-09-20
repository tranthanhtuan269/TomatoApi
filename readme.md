# TomatoApi

install
1. composer update
2. add passport

--------------------------------------------------------------
POST: localhost:8000/api/auth/signup
-------------------------------
Content-Type: application/json
X-Requested-With: XMLHttpRequest
-------------------------------
{
	"name" : "tranthanhtuan",
	"email": "tran.thanh.tuan269@gmail.com",
	"password": "123456",
	"password_confirmation": "123456",
	"phone": "0973619398",
	"city_id": "1",
	"district_id": "1",
	"street_id": "1",
	"address": "So 68, to 8"
}
--------------------------------------------------------------

--------------------------------------------------------------
POST: localhost:8000/api/auth/login
-------------------------------
Content-Type: application/json
X-Requested-With: XMLHttpRequest
-------------------------------
{
	"email": "tran.thanh.tuan269@gmail.com",
	"password": "123456",
	"remember_me": true
}
--------------------------------------------------------------

--------------------------------------------------------------
GET: localhost:8000/api/auth/logout
-------------------------------
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIxMjI2YjI0ZWM0YjEzZmRhZmQ2NmQzYmZlM2QzZjllMDA4MDg2NDRlZmJkZDM1NWNkZmVkZDNhZGZkN2Y2NDhlOGI2NTgyNTQxZGY1MzUyIn0.eyJhdWQiOiIxIiwianRpIjoiMjEyMjZiMjRlYzRiMTNmZGFmZDY2ZDNiZmUzZDNmOWUwMDgwODY0NGVmYmRkMzU1Y2RmZWRkM2FkZmQ3ZjY0OGU4YjY1ODI1NDFkZjUzNTIiLCJpYXQiOjE1MzQ4MTc4NjQsIm5iZiI6MTUzNDgxNzg2NCwiZXhwIjoxNTY2MzUzODY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Me9yt-wyga3boPWCMWTFrl6f9Jlf6A8D3TiOV39R89hVJswsp_3K3d06LbKOqVc0eZMlnpEib0mthCT3-h0FbA5Nxty16sKqPfx5Vs4qgNaBD7EHviYXk3EjJv8_4oGxWwHE5X3qMDnRv5I4VK6jNmYoFxSsoeztuhs7y7foo9oOE3hnEh5kACcwXn32ZKDZUKIbZtOErAfaB2rzM_dDx5R_DFmp1yJX2Xrc41axbj9OvTXAy0Q61g6oBb3SfBKnjHU1Z09meahOkhjEqWziOPp7NAc89YPcL0YB3ev8ip8Usm3L8yy1M-jLv0JYCIulDuzeNl56zJNlnVL8zpQuZczaOr__Q1K5QZYXmNpeeJVFzEYaNL9XcIklEYg-Yp4xtXO2HxMooo-tI5DJ62b8ep6kWtR7eAFVAS85Vt4F1VL2kxew89hQh9ZuwYemGPtZ_OUu_YGkFZngWIH2psGij18_5d9qJSR2aZQ-wS_1JvBTyHQdGEUsqB4Rz87KrhCN4eBgW8aBwDQwkMdQA2VMhTSqB9Xoj2Vjdtwu13xhoQPqKD88NgUahF5gChWSsxd3RE4cUrH-0tbmzi1qdziYlLyq99miZCbv3yrAseOY3SLr6u6lkwnGlyICxawAMKDzvk6ZC1wKLPZ21bNT1LGZ037V6M9jwkrGJ_2mizSLuag
-------------------------------

--------------------------------------------------------------

--------------------------------------------------------------
GET: localhost:8000/api/auth/user
-------------------------------
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIxMjI2YjI0ZWM0YjEzZmRhZmQ2NmQzYmZlM2QzZjllMDA4MDg2NDRlZmJkZDM1NWNkZmVkZDNhZGZkN2Y2NDhlOGI2NTgyNTQxZGY1MzUyIn0.eyJhdWQiOiIxIiwianRpIjoiMjEyMjZiMjRlYzRiMTNmZGFmZDY2ZDNiZmUzZDNmOWUwMDgwODY0NGVmYmRkMzU1Y2RmZWRkM2FkZmQ3ZjY0OGU4YjY1ODI1NDFkZjUzNTIiLCJpYXQiOjE1MzQ4MTc4NjQsIm5iZiI6MTUzNDgxNzg2NCwiZXhwIjoxNTY2MzUzODY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Me9yt-wyga3boPWCMWTFrl6f9Jlf6A8D3TiOV39R89hVJswsp_3K3d06LbKOqVc0eZMlnpEib0mthCT3-h0FbA5Nxty16sKqPfx5Vs4qgNaBD7EHviYXk3EjJv8_4oGxWwHE5X3qMDnRv5I4VK6jNmYoFxSsoeztuhs7y7foo9oOE3hnEh5kACcwXn32ZKDZUKIbZtOErAfaB2rzM_dDx5R_DFmp1yJX2Xrc41axbj9OvTXAy0Q61g6oBb3SfBKnjHU1Z09meahOkhjEqWziOPp7NAc89YPcL0YB3ev8ip8Usm3L8yy1M-jLv0JYCIulDuzeNl56zJNlnVL8zpQuZczaOr__Q1K5QZYXmNpeeJVFzEYaNL9XcIklEYg-Yp4xtXO2HxMooo-tI5DJ62b8ep6kWtR7eAFVAS85Vt4F1VL2kxew89hQh9ZuwYemGPtZ_OUu_YGkFZngWIH2psGij18_5d9qJSR2aZQ-wS_1JvBTyHQdGEUsqB4Rz87KrhCN4eBgW8aBwDQwkMdQA2VMhTSqB9Xoj2Vjdtwu13xhoQPqKD88NgUahF5gChWSsxd3RE4cUrH-0tbmzi1qdziYlLyq99miZCbv3yrAseOY3SLr6u6lkwnGlyICxawAMKDzvk6ZC1wKLPZ21bNT1LGZ037V6M9jwkrGJ_2mizSLuag
-------------------------------

--------------------------------------------------------------
