# 🛎️ Service Reservation System

A simple service reservation system using Laravel that allows users to browse and book services, with an admin dashboard built using Filament.

---

## ✅ Business Requirements Understanding

This system is designed to simplify the online booking of services, whether it's consultations, medical services, or any other service. Instead of people calling or sending messages to book, they can go to the website or app, select the service they need, and choose a suitable time easily.

Each user can also track their bookings, modify them, or cancel them if necessary. On the other hand, the system administrators have full control to add and modify services, as well as manage all bookings and appointments.

The idea is to reduce manual communication that could cause confusion or delays, and to keep everything organized, easy, and professional for both the client and the administrator.

---

## 💡 Feature Suggestion

- **Booking Notifications:** Add email or SMS reminders to notify users about their bookings.
- **Online Payment:** Integrate payment gateways like Paymob or Fawry to collect payment before confirming the booking.
- **Categories and Filters:** Make it easier to browse services by filtering by type or price.
- **OAuth Login:** Support login via Google or Facebook.
- **Caching and Faster Loading:** Use caching to improve performance and upload images to S3.
- **Multiple Booking Support:** Allow multiple users to book the same service at the same time (if no actual conflict).
- **Forgot Password:** Support easy password recovery.

---

## 🛠️ Tool Choices & Design Decisions

| Tool | Reason |
|------|--------|
| Laravel 10 | A robust and modern framework to organize code easily |
| MySQL | A popular database that's easy to integrate with Laravel |
| Filament | A ready-to-use and easy-to-use admin panel |
| Blade Templates | To create simple and fast pages |
| List.js | To filter and sort the list of services in the interface |
| Laravel Seeder/Factory | To generate test data easily during development |

---

## ⚠️ Notes

- The design has some issues and isn't the best (responsive).

---
## 🧪 Explanation video : https://drive.google.com/file/d/1_2uv7IOUh4lcU2SKY563MRRtnOKrsQ19/view?usp=drive_link
## 🧪 Github Link : https://github.com/Naderabdou/Reservation-System
## 🧪 POSTMAN : https://documenter.getpostman.com/view/42925117/2sB2j7eVtH

----

👤 **Admin Access**  
  - **Email:** admin@gmail.com  
  - **Password:** password

---

## ⚙️ Setup Instructions

1. **Clone the project:**

```bash
git clone https://github.com/yourusername/service-reservation.git
cd service-reservation
composer install 
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
