# Janata – Online Public Distribution System

Janata is a comprehensive web application designed to digitize and streamline the Public Distribution System (PDS) in India. Developed using **PHP**, **MySQL**, and **HTML/CSS**, the platform ensures transparent and efficient distribution of rationed goods to eligible citizens, while also offering access to non-subsidized goods (Supplyco items).

## User Roles & Access Levels

1. Citizens (Users)
   Citizens register using their **email** and **ration card details**, and must verify their account using an **OTP sent to their email**. They are categorized based on their **ration card type**:
   - **Yellow Card**: Access to high-subsidy essential goods.
   - **Pink Card**: Limited subsidy or no subsidy.
   - **Blue Card**: Moderate subsidy.

   After registration, access is **pending approval** by the respective **Store Operator**.

   Once approved:
   - They can **place orders** for both **subsidized items** (like rice, wheat, sugar) and **non-subsidized goods** (from Supplyco).
   - Their access to items and quotas depends on their **card type**.
   - They can **track order status** and **view delivery updates**.

2. **Store Operator**  
   The store operator is responsible for:
   - **Approving or rejecting user registration requests**.
   - **Managing stock**: Adding, updating, and reducing stock based on availability and orders placed.
   - Viewing **remaining stock** and monitoring supply levels.
   - Managing **delivery partners**, including assigning orders and viewing their delivery status.

3. **Delivery Partner**  
   Managed by the Store Operator, delivery partners:
   - Receive delivery assignments.
   - Can **approve or decline** delivery requests.
   - Update **delivery status**, keeping users informed about their order journey.

4. **Admin**
   The admin panel provides centralized control:
   - **Manages all users and store operators**.
   - Can **remove or block accounts**, reset stock levels, and oversee system operations.

---

### Login & Verification

- Users log in using their **email and password**.
- During registration, a **secure OTP-based verification system** ensures only valid users gain access.
- Store Operators must **manually approve each citizen registration** before access is granted.

---

### Ordering & Stock Management

- Users see only items **relevant to their card type**.
- They can add **both subsidized and non-subsidized items** to their cart.
- Orders are placed and processed by the **Store Operator**, with delivery managed by the assigned partner.
- Operators have real-time views of **stock left**, and can plan distribution accordingly.

