#
# Modifying tt_content table
#
CREATE TABLE tt_content (
  tx_content_animations_animation tinytext,
  tx_content_animations_duration tinyint DEFAULT 800,
  tx_content_animations_delay tinyint DEFAULT 0,
);
