# 🏋️‍♂️ FitnessBro — Full-Stack Fitness Web App

**University Team Project — Backend Development by [Badreldin Elsayed](https://github.com/Bader123457)**  
· Year: 2025

---

## 📌 Project Overview

FitnessBro is a dynamic full-stack fitness web platform that helps users:

- Calculate their daily calorie expenditure
- Track and store meals using real nutrition data
- Follow personalized meal and workout plans
- Record body metrics (weight, height) for adaptive recommendations
- View video-based workout guides and health tips

This project was built as part of our first-year Computer Science team project at the University of Manchester.

---

## 👨‍💻 My Role: Backend Developer

I was responsible for **building the backend infrastructure**, focusing on:

✅ **Meal Plan Generator**  
Designed and implemented backend logic to produce balanced, personalized meal plans based on user input and health goals.

✅ **Nutritionix API Integration**  
Integrated the [Nutritionix API](https://developer.nutritionix.com/) to fetch real-time nutritional data and connected it with the user’s meal logs and planning system.

✅ **MySQL Database Management**  
Built and maintained robust backend models to handle user data, meal logs, body metrics, and API results — using secure and scalable MySQL schema design.

✅ **Secure API Credential Handling**  
Configured and validated `.env` files and PHP configuration for both Nutritionix API and MySQL database connectivity.

---

## 🧠 Key Features

- 🔢 **Calorie calculator** based on user body data
- 🍎 **Nutrition search** via Nutritionix API
- 🍱 **Meal plan storage** and logging
- 🏃 **Exercise tracking** using the Compendium of Physical Activities
- 📹 **Workout videos and guidance**
- 👤 **User authentication** and data persistence

---

## 🛠️ Tech Stack

### 🧩 Backend
- **PHP** (Vanilla, procedural and OOP blend)
- **MySQL** for data storage
- **Nutritionix API** for nutrition data
- **Apache** HTTP server
- `.env`-based credential handling

### 🎨 Frontend
- HTML, CSS
- Vanilla JavaScript

---

## 📂 Project Structure

fitness-bro/
├── assets/ # Images and other static files
├── config/ # API and database credentials
├── database/ # MySQL schema files
├── public/ # index.php (entry point, handles routing)
├── src/
│ ├── Controllers/ # Application logic
│ ├── Models/ # Backend logic (data + API)
│ └── Views/ # HTML templates and UI
└── README.md



## 📬 Setup & Credentials

Make sure you create and configure:

- `config/db-credentials.env` for MySQL access
- `config/nutritionix-credentials.env` for API access

---

## 👨‍👩‍👧‍👦 Team Members

This project was completed in collaboration with:
- Elliot Holbrook
- Akshit Palamthody
- Yi Xuan Phoon
- Armaan Ahmed
- Youssef Abouelnasr
- **Badreldin Elsayed** (Me)

---

## 🧠 Reflections

This project helped me develop hands-on skills in:

- API integration and data pipelines
- Secure credential management
- Full backend architecture and database design
- Working in a collaborative team environment

---

## 🚀 Future Improvements

- OAuth integration for better login security
- Enhanced personalization using user history
- Mobile-responsive design

---



