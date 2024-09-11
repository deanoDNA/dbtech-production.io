-- services_table: stores available services
CREATE TABLE services_table (
    service_id INT PRIMARY KEY AUTO_INCREMENT,
    service_name VARCHAR(255),
    service_price DECIMAL(10, 2),
    service_image VARCHAR(255)
);

-- requests_table: stores user requests for services
CREATE TABLE requests_table (
    request_id INT PRIMARY KEY AUTO_INCREMENT,
    service_id INT,
    user_id INT,
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    custom_problem TEXT,
    status VARCHAR(50) DEFAULT 'Pending',
    FOREIGN KEY (service_id) REFERENCES services_table(service_id)
);

-- Sample data for services_table
INSERT INTO services_table (service_name, service_price, service_image) VALUES
('Towing Service', 10000.00, 'towing.jpg'),
('Battery Jumpstart', 5000.00, 'jumpstart.jpg'),
('Flat Tire Change', 7000.00, 'tire_change.jpg'),
('Fuel Delivery', 8000.00, 'fuel_delivery.jpg');
