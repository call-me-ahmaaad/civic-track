<img width="1584" height="396" alt="Abstract Technology Profile LinkedIn Banner" src="https://github.com/user-attachments/assets/c7ff107e-7ae4-43df-b5a9-5f3d626db790">

---
A straightforward resident data management system built for village-level administration.

![Static Badge](https://img.shields.io/badge/STATUS-In--progress-%23E16B16?style=for-the-badge)
![Static Badge](https://img.shields.io/badge/LICENSE-MIT-blue?style=for-the-badge)

## 📌 What is this?

CivicTrack is a simple web-based civil registration system for managing 
resident and family data at the village level. It covers the two most 
essential documents — family card and national identity card — with a 
dashboard that gives a quick overview of the resident population.

This is actually a rebuild of a project I worked on during my Community 
Service Program. That version was built with Laravel, worked well enough 
to get submitted, but honestly? It was a mess under the hood. Too many 
hands, too little structure, and I wasn't fully in control of what I was 
building.

So CivicTrack is me going back and doing it properly. Same concept, 
cleaner execution — pure HTML, CSS, JavaScript, and PHP. No framework, 
no shortcuts. Just a deliberate, structured rebuild from the ground up.

That said, it wasn't without its struggles. On the backend, a lot of the 
difficulty came down to OOP decisions — specifically, what to keep and 
what to cut. I ended up removing the Model layer entirely and keeping 
validation separate from the data layer, but looking back, some of those 
calls could have been made differently. Validators living inside Models, 
for instance, is a valid approach I didn't fully explore.

On the frontend, the hardest part wasn't the styling — it was deciding 
what data to actually show in a table. Not everything fits, and figuring 
out what matters most to the user is a design problem I didn't have a 
clean answer for going in.

Is it perfect? Not even close. But it's done, it works, and I learned a 
lot building it — from architecture decisions and OOP principles down to 
syntax and debugging. There's still plenty to improve, and I'll get back 
to it when time allows.

### ℹ️ P.S.: Most of the changes in this version happened behind the scenes.

The previous version was already functional, but a large part of the project has since been reworked to improve its structure and maintainability. Models are now used throughout the application and handle their own validation where it makes sense, while additional validation still exists for business rules and database-related constraints. Controllers have also become much cleaner thanks to the introduction of dedicated service classes.

A few other parts of the project were revisited as well. The alert system was redesigned to provide a more consistent experience across the application, the database layer was moved into the Infrastructure directory, and configuration files were replaced with environment variables.

On the front-end side, I honestly did not make as many improvements as I would have liked. CSS organization and color palette choices are still areas where I have a lot to learn. The interface is more consistent than before, but it is probably the part of the project that still needs the most work moving forward.

Still the same CivicTrack, just built with a little more experience than before.

---

## ✨ Features

- 👨‍👩‍👧‍👦 Family management — add, edit, and delete family records
- 🪪 Resident management — add, edit, and delete resident records
- 🔍 Search residents or families by various types of data
- 📊 Dashboard with resident statistics — total family, total residents, gender, religion, education, and occupation breakdown
- 🔐 Admin authentication

---

## 🛠️ Tech Stack

![Static Badge](https://img.shields.io/badge/HTML-%23E5532D?style=for-the-badge&logo=html5&logoColor=white)
![Static Badge](https://img.shields.io/badge/CSS-%230277BD?style=for-the-badge&logo=css&logoColor=white)
![Static Badge](https://img.shields.io/badge/JavaScript-%23F7E025?style=for-the-badge&logo=javascript&logoColor=black)
![Static Badge](https://img.shields.io/badge/PHP-%23787CB4?style=for-the-badge&logo=php&logoColor=white)
![Static Badge](https://img.shields.io/badge/MySQL-%23086590?style=for-the-badge&logo=mysql&logoColor=white)

---

## 📁 Project Structure

```
CivicTrack/
├── bootstrap/                  # App initialization
│   ├── app.php                 # DI container & controller wiring
│   └── database.php            # Database bootstrap
│
├── public/                     # Web server document root
│   ├── css/
│   │   ├── components/         # Reusable component styles
│   │   ├── pages/              # Page-specific styles (per domain)
│   │   ├── base.css
│   │   ├── error.css
│   │   ├── layout.css
│   │   └── reset.css
│   ├── img/
│   ├── js/
│   │   ├── tables/             # DataTable initializations
│   │   ├── validations/        # Client-side form validations (per domain)
│   │   └── alert.js
│   ├── .htaccess
│   └── index.php               # Application entry point
│
├── routes/
│   └── web.php
│
├── src/
│   ├── controllers/
│   ├── exceptions/
│   ├── infrastructure/         # Low-level technical concerns (DB wrapper)
│   ├── models/
│   ├── repositories/           # Database query operations
│   └── services/
│       └── validators/
│
├── views/
│   ├── auth/
│   ├── components/             # Reusable view components
│   ├── dashboard/
│   ├── errors/
│   ├── families/
│   └── residents/
│
├── .env.example
├── composer.json
└── README.md
```
---

## 🚀 Getting Started

### Prerequisites

- PHP 8.4
- Composer
- MySQL
- Laragon (recommended)

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/CivicTrack.git
cd CivicTrack
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure the Database

Copy the config file and fill in your database credentials:

```bash
cp config/database.example.php config/database.php
```

### 4. Setup the Database

Import the schema into MySQL:

```bash
mysql -u root -p < schema.sql
```

Then seed the reference tables (cities, religions, educations, occupations, family roles) manually or via your preferred MySQL client.

### 5. Setup Virtual Host

Point your web server's document root to the `public/` directory. If you're using Laragon, it handles this automatically when the project is placed in the `www/` folder — just make sure the document root is set to `public/`.

### 6. Create an Admin Account

Run this in your MySQL client to generate a hashed password:

```bash
php -r "echo password_hash('your_password', PASSWORD_DEFAULT);"
```

Then insert the admin user:

```sql
INSERT INTO users (username, password) VALUES ('your_username', 'hashed_password');
```

### 7. Open in Browser

```
http://civictrack.test
```

---

## 📄 License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgment

CivicTrack is rooted in a project I built during my Community Service Program (KKN). A big thank you to **Pradita University** for the opportunity, and to my fellow KKN teammates who contributed in more ways than one during that time — the collaboration, the chaos, and everything in between.

This rebuild is a solo effort, but it wouldn't exist without that shared experience as the foundation.

---

## 💬 Closing

This project is far from perfect, and I know that. A lot of what I took away from building CivicTrack wasn't just technical — it was about decision-making. Knowing when to add abstraction and when to leave it out. Knowing what's worth the complexity and what isn't. Those are the kinds of lessons that don't come from reading about architecture, they come from actually building something and sitting with the consequences of your choices.

There's still plenty to improve. But for now, it works — and that's enough to move forward from. 🙏
