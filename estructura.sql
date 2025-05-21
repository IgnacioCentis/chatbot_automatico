CREATE TABLE ia_conversaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conversacion_id VARCHAR(50),
    emisor VARCHAR(20),
    mensaje TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
