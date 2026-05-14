<img width="1584" height="396" alt="Abstract Technology Profile LinkedIn Banner" src="https://github.com/user-attachments/assets/cbd88e31-cdc0-4a77-96f2-d27e19189904">

---
A straightforward resident data management system built for village-level administration.

![Static Badge](https://img.shields.io/badge/STATUS-In--progress-%23E16B16?style=for-the-badge)
![Static Badge](https://img.shields.io/badge/LICENSE-MIT-blue?style=for-the-badge)

## 📌 What is this?

CivicTrack is a simple web-based civil registration system for managing resident and family data at the village level. 
It covers the two most essential documents — family certificate and identity card — with a dashboard that gives a quick overview of the resident population.

This is actually a rebuild of a project I worked on during Community Service Program. That version was built with Laravel, worked well enough to get submitted, but honestly? 
It was a mess under the hood. Too many hands, too little structure, and I wasn't fully in control of what I was building.

So CivicTrack is me going back and doing it properly. Same concept, cleaner execution — pure HTML, CSS, JavaScript, and PHP. 
No framework, no shortcuts. Just a deliberate, structured rebuild from the ground up.

---

## ✨ Features

- 👨‍👩‍👧‍👦 Family management — add, edit, and delete family records
- 🪪 Resident management — add, edit, and delete resident data
- 🔍 Search residents by name or National ID Number
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
civic-track/
├── config/
│   └── database.php          # Database connection
├── src/
│   ├── helpers/              # Reusable functions (auth check, redirect, etc.)
│   ├── models/               # Database queries (Family, Resident, User)
│   └── controllers/          # Logic handlers (form processing, CRUD)
├── views/
│   ├── layouts/              # Reusable components (sidebar, header)
│   ├── dashboard/
│   ├── warga/
│   ├── kartu-keluarga/
│   └── auth/                 # Login page
├── assets/
│   ├── css/
│   ├── js/
│   └── img/
├── .htaccess                 # Redirects all requests to index.php
└── index.php                 # Entry point & routing
```

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.4
- MySQL

### 1. Clone the Repository

```bash
git clone https://github.com/call-me-ahmaaad/civic-track.git
cd civic-track
```

### 2. Configure the Database

Copy the config file and fill in your database details:

```bash
cp config/database.example.php config/database.php
```

### 3. Import the Database

Import the provided SQL file into your MySQL database.

### 4. Run the App

```bash
php -S localhost:8000
```

Open your browser and go to `http://localhost:8000`.

---

> If you run into any issues getting this up and running, feel free to reach out to me directly. Sorry if this setup guide isn't as helpful as it could be — documentation is something I'm still working on. 🙏
