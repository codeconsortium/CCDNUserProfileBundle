Feature: User Profile Traversal
	In order to list and view profiles.
	As an User
	I want to be able to view profiles and update my own profile.

    Background:
        Given I am logged in as "user1"
        And there are following users defined:
          | name  | email          | password | enabled  | role      |
          | user1 | user1@foo.com  | root     | 1        | ROLE_USER |
		  | user2 | user2@foo.com  | root     | 1        | ROLE_USER |
		  | user3 | user3@foo.com  | root     | 1        | ROLE_USER |
        And the following profiles have been filled in:
          | user  | country        | city   | real_name | birthday | company        | position | bio | signature | msn           | aim           | yahoo           | icq  |
		  | user2 | United Kingdom | London | Reece     | 1/1/1987 | CodeConsortium | CEO      |     |           | reece@msn.com | reece@aim.com | reece@yahoo.com | 1234 |

	Scenario: See Users list
        Given I am on "/en/members"
		And I should see "user1"
		And I should see "user2"
		And I should see "user3"

	Scenario: View another users profile
        Given I am on "/en/members"
		And I should see "user1"
		And I should see "user2"
		And I should see "user3"
		And I follow "user2"
		And I should see "United Kingdom"
		And I should see "London"
		And I should see "1987 Jan 01"
		And I should see "CodeConsortium"
		And I should see "CEO"
		And I should see "reece@msn.com"
		And I should see "reece@aim.com"
		And I should see "reece@yahoo.com"
		And I should see "1234"

	Scenario: View my profile and update personal section
        Given I am on "/en/members"
		And I should see "user1"
		And I should see "user2"
		And I should see "user3"
		And I follow "user1"
		And I follow "edit_profile[personal]"
		And I select "United Kingdom" from "ProfilePersonal[location_country]"
		And I fill in "ProfilePersonal[location_city]" with "London"
        And I press "submit[post]"
		And I should see "London, GB"

	Scenario: View my profile and update avatar section
        Given I am on "/en/members"
		And I should see "user1"
		And I should see "user2"
		And I should see "user3"
		And I follow "user1"
		And I follow "edit_profile[avatar]"
		And I fill in "ProfileAvatar[avatar]" with ""
        And I press "submit[post]"

	Scenario: View my profile and update info section
        Given I am on "/en/members"
		And I should see "user1"
		And I should see "user2"
		And I should see "user3"
		And I follow "user1"
		And I follow "edit_profile[info]"
		And I fill in "ProfileInfo[real_name]" with "My Real Name"
		And I select from "select[id^=ProfileInfo_birth_date]" a date "01-01-1988"
		And I fill in "ProfileInfo[company]" with "CodeConsortium"
		And I fill in "ProfileInfo[position]" with "CEO"
        And I press "submit[post]"
		And I should see "My Real Name"
		And I should see "1988 Jan 01"
		And I should see "CodeConsortium"
		And I should see "CEO"

	Scenario: View my profile and update contact section
        Given I am on "/en/members"
		And I should see "user1"
		And I should see "user2"
		And I should see "user3"
		And I follow "user1"
		And I follow "edit_profile[contact]"
		And I fill in "ProfileContact[msn]" with "me@msn.com"
		And I fill in "ProfileContact[aim]" with "me@aim.com"
		And I fill in "ProfileContact[yahoo]" with "me@yahoo.com"
		And I fill in "ProfileContact[icq]" with "4321"
        And I press "submit[post]"
		And I should see "me@msn.com"
		And I should see "me@aim.com"
		And I should see "me@yahoo.com"
		And I should see "4321"

	Scenario: View my profile and update bio section
        Given I am on "/en/members"
		And I should see "user1"
		And I should see "user2"
		And I should see "user3"
		And I follow "user1"
		And I follow "edit_profile[bio]"
		And I fill in "ProfileBio[bio]" with "This is my biography"
        And I press "submit[post]"
		And I should see "This is my biography"

	Scenario: View my profile and update signature section
        Given I am on "/en/members"
		And I should see "user1"
		And I should see "user2"
		And I should see "user3"
		And I follow "user1"
		And I follow "edit_profile[signature]"
		And I fill in "ProfileSignature[signature]" with "This is my signature"
        And I press "submit[post]"
		And I should see "This is my signature"

    Scenario: Filter list of members
        Given I am on "/en/members/?alpha=U"
        Then I should a profile link for "user"
