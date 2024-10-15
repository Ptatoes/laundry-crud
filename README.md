# Laundry Service Management System - Laravel 11 CRUD Project

## Project Overview

This project is a simple laundry service management system built with Laravel 11. It allows users to manage laundry orders, services, and customers. Users can perform CRUD (Create, Read, Update, Delete) operations on orders, services, and customer information.

### Database Structure

Customers: Stores customer information, including names and contact details, allowing users to keep track of who placed laundry orders.
Orders: Contains details about each laundry order, such as the service selected, the weight of laundry, the order date, and the price. Each order is linked to a customer.
Services: Lists the available laundry services, such as dry cleaning or ironing, along with their respective prices. Each order is associated with a specific service.
The Orders table has foreign key relationships with both the Customers and Services tables:

Each order is associated with a specific customer.
Each order is linked to a specific service.

This project aims to provide a user-friendly platform for managing laundry service operations efficiently, allowing users to handle customer orders and services with ease.
