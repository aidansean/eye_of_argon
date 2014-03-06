from project_module import project_object, image_object, link_object, challenge_object

p = project_object('eye_of_argon')
p.domain = 'http://www.aidansean.com/'
p.path = 'eye_of_argon'
p.preview_image_ = image_object('http://placekitten.com.s3.amazonaws.com/homepage-samples/408/287.jpg', 408, 287)
p.github_repo_name = 'eye_of_argon'
p.mathjax = False
p.links.append(link_object(p.domain, 'eye_of_argon/', 'Live page'))
p.introduction = 'This project was made to demonstrate a point.  A student said that they doubted I could make a simple application in an afternoon, so within about an hour I had made this is.  It takes a string from the user and makes a phrase using word from the Eye of Argon to make an initialisation.'
p.overview = ''

p.challenges.append(challenge_object('The numbers of words in the Eye of Argon is larger than 10,000, which could slow down performance.', 'The words were sorted alphabetically, with duplicates removed, and words with fewer than four letters are removed.', 'Resolved'))

print p.wordpress_text()
