CCDN User README.
==================


Notes:  
------
  
This bundle is for the symfony framework and thusly requires Symfony 2.0.x and PHP 5.3.6
  
This project uses Doctrine 2.0.x and so does not require any specific database.
  

This file is part of the CCDNUser bundles(s)

(c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 

Available on github <http://www.github.com/codeconsortium/>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.

Dependencies:
-------------

FOSUserBundle is a depedency for this collection of bundles. You also
need the PagerFanta bundle.

Installation:
-------------
    
1) Create the directory src/CCDNUser in your Symfony directory.
  
2) Add the Bundle to CCDNUser directory.  

3) In your AppKernel.php add the following bundles to the registerBundles method array:  

	new CCDNUser\MemberBundle\CCDNUserMemberBundle(),    
	new CCDNUser\ProfileBundle\CCDNUserProfileBundle(),    
	new CCDNUser\UserAdminBundle\CCDNUserUserAdminBundle(),    
	new CCDNUser\UserBundle\CCDNUserUserBundle(),    
	

4) Download and install the pagerfanta bundle as it is required. 
Follow the pagerfanta install instructions.  
	  
5) In your app/config/config.yml add:    

	  
6) In your app/config/routing.yml add:  

	member:  
		resource: "@CCDNUserMemberBundle/Resources/config/routing.yml"  
	profile:
		resource: "@CCDNUserProfileBundle/Resources/config/routing.yml"  
	referer:
		resource: "@CCDNUserRefererBundle/Resources/config/routing.yml"  
	user_admin:
		resource: "@CCDNUserUserAdminBundle/Resources/config/routing.yml"  
	user:
	    resource: "@CCDNUserUserBundle/Resources/config/routing.yml"  

7) Symlink assets to your public web directory by running this in the command line:

	php app/console assets:install --symlink web/