SELECT insect_categories.insectid, categories.categoryid, categories.name
FROM insect_categories
JOIN categories on insect_categories.categoryid = categories.categoryid;