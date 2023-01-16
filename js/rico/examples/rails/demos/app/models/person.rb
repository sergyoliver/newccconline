class Person 
   attr_accessor :title, :first_name, :last_name, :street_address, :city, :state, :zip_code, :phone, :mobile, :occupation, :notes
   
   def initialize(title, first_name, last_name, street_address, city, state, zip_code, phone, mobile, occupation, notes)
     @title = title;
     @first_name = first_name;
     @last_name = last_name;
     @street_address = street_address;
     @city = city;
     @state = state;
     @zip_code = zip_code;
     @phone = phone;
     @mobile = mobile;
     @occupation = occupation;
     @notes = notes;
   end
   
   @@people = [Person.new('Mrs.', 'Debbie',  'Holloman', '2243 Fallenwood Street', 'Dallas', 'TX',
                           '75555-3483', '(214) 555-2343', '(214) 555-2144', 'Administrative Assistant', 'Has a house on the east-side by my cousin.'),
               Person.new('Mr.', 'Pat',  'Barnes', '1743 1st Avenue', 'Boston', 'MA',
                           '71204-2345', '(972) 555-0293', '(972) 555-0295', 'Executive Vice President', 'Spouse playes tennis at the country club with John.'),
               Person.new('Mrs.', 'Joan',  'Dampier', '535 Market Street', 'Chicago', 'IL',
                           '76933-2359', '(318) 555-3424', '(318) 555-3326', 'Chief Information Officer', 'Sci-Fi buff.'),
               Person.new('Dr.', 'Randy',  'Alvarez', '15 Magnolia Drive', 'Los Angeles', 'CA',
                           '79333-2323', '(233) 555-3920', '(233) 555-3427', 'Design Consultant', 'Friends with Peter Jackson.'),
               Person.new('Sir', 'William',  'Neil', '234 Forsythe Avenue', 'San Fransisco', 'CA',
                           '74234-3090', '(789) 555-2349', '(789) 555-2548', 'Chief Financial Officer', 'Has a cool stamp collection.'),
               Person.new('Miss', 'Kimber',  'Hardoway', '32 Wells Road', 'New York', 'NY',
                           '78334-3973', '(743) 555-3245', '(743) 555-3649', 'Chief Technology Officer', 'Met thru Katie at the downtown club.'),
               Person.new('Mrs.', 'Leslie',  'Story', '834 Thomas Road', 'Atlanta', 'GA',
                           '72890-3423', '(817) 555-2349', '(817) 555-2740', 'Ajax Evangelist', 'Knows CSS and DHTML like a god.'),
               Person.new('Mr.', 'Charlie',  'Lott', '8888 Spartan Rd.', 'Washington D.C.', 'VA',
                           '70938-3445', '(404) 555-9843', '(404) 555-9841', 'Talk Radio Host', 'Understands subtle verbal cues.'),
               Person.new('Mrs.', 'Sabrina',  'Patton', '69 Stewart Street', 'Seattle', 'WA',
                           '74905-3286', '(489) 555-4395', '(489) 555-4992', 'Self Employeed', 'Perpetually happy.'),
               Person.new('Mr.', 'Juan',  'Lopez', '8992 Nondescript Road', 'Las Vegas', 'NV',
                           '70923-4032', '(484) 555-0002', '(484) 555-1003', 'Tax Attorney', 'Got Sarah a big refund last year.'),
             ]
             

   
   def Person.find_by_name(first_name, last_name)
      @@people.each do |p|
         return p if (first_name==p.first_name && last_name==p.last_name);
      end     
      @@people[0]      
   end
                  
end
