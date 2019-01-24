/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mess;

/**
 *
 * @author ASUS
 */
class User {
    private String Breakfast,Lunch,Dinner;
    private String name;
    public User(String Breakfast,String Lunch,String Dinner,String name){
        this.name=name;
        this.Breakfast=Breakfast;
        this.Lunch=Lunch;
        this.Dinner=Dinner;
    }
    public String getname(){
        return name;
    }
    public String getBreakfast(){
        return Breakfast;
    }
    public String getLunch(){
        return Lunch;
    }
    public String getDinner(){
        return Dinner;
    }
    
}
