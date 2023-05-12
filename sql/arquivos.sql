CREATE TABLE arquivos( 
    id INT NOT NULL AUTO_INCREMENT, 
    id_usuario INT NOT NULL, 
    arquivo VARCHAR(250) NOT NULL, 
    upload DATETIME NULL,
    PRIMARY KEY(id), 
    FOREIGN KEY(id_usuario) REFERENCES usuarios(id)); 