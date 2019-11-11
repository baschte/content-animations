#
# Modifying tt_content table
#
CREATE TABLE tt_content (
  tx_content_animations_animation tinytext,
  tx_content_animations_duration tinyint DEFAULT 800,
  tx_content_animations_delay tinyint DEFAULT 0,

  tx_content_animations_offset tinyint DEFAULT 0,
  tx_content_animations_once tinyint DEFAULT 1,
  tx_content_animations_mirror tinyint DEFAULT 0,
  tx_content_animations_easing tinytext,
  tx_content_animations_anchor_placement tinytext
);
