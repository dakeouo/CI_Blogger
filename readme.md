網站瀏覽：[My Blog](https://dake.work/ciblog/)

![image](https://i.imgur.com/XqShsxs.png)

# 初代個人自製網站

使用 [Codeigniter](https://codeigniter.com/) MVC框架所開發而成，並套用 [ION](https://www.themezy.com/free-website-templates/84-classic-ion-free-responsive-template) 網頁模板所製成的個人網站。

## 網站功能

### 前端
- 文章瀏覽與閱讀
- 標籤/類別文章篩選
- 關於我頁面瀏覽
- CPE一星題頁面

### 後端
- 文章管理與預覽
- 標籤/類別管理
- 關於我頁面資訊管理
- CPE一星題頁面資訊管理

## [之前]所用套件
因目前該網站已轉為個人作品展示用，故下列套件已於此網站停用，但在目前的[個人網站](http://terahake.in/)皆正在使用中
- [Google Analytics](https://analytics.google.com/analytics/web/)：網頁訪客數據瀏覽與分析
- [Disqus](https://disqus.com/)：訪客留言管理系統

## 資料表關聯圖
![image](https://i.imgur.com/9uHgMgx.png)
使用5個資料表，有3個主要的資料表：
- 使用者資訊(users)：紀錄使用者資訊。包含信箱、密碼(以MD5方式儲存)、名稱等
- 社群應用資訊(app_icon)：紀錄我的社群應用資訊(例如IG、FB、YT等)。共有四個欄位，因應用圖示使用Fontawsome，故有兩個欄位(icon_front, icon_id)是在記錄該社群圖示用，其餘兩欄位分別為名稱(app)及連結(link)
- 文章內容資訊(artices)：紀錄文章資訊。包含標題、類別、建立時間、修改時間等。還有兩個資料表來分儲存**標籤**與**類別**
  - 標籤(tags)
  - 類別(categorys)

## Designer
[Dake Hong](https://github.com/dakeouo)