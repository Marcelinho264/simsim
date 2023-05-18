CREATE TABLE `compartilhar` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_arquivo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  FOREIGN KEY (id_arquivo) REFERENCES arquivos(id),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);