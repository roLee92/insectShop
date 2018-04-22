SELECT *
FROM insect_categories
JOIN categories on insect_categories.categoryid = categories.categoryid
WHERE insectid = :insectid