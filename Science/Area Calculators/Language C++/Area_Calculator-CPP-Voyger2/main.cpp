#include <iostream>
using namespace std;
int main(){
    int l,b,h,r,ar; //Length Bredth, Height, Radius respectively 
    // b can be used as Bredth of Rectangle and Base of a Triangle
    char s; // Shape

    cout << "Enter the desired shape from : \n " << "a. Rectangle\n" << "b. Circle\n" << "c. Triangle\n";
    cin >> s;

    switch(s){
        case 'a':
        cout << "\nEnter the length of Rectangle: ";
        cin >> l;
        cout << "\nEnter the Bredth of Rectangle: ";
        cin >> b;
        ar = l*b;
        cout << ar << '\n';
        break;

        case 'b':
        cout << "Enter the Radius of Circle: ";
        cin >> r;
        ar = 3.14*r*r;
        cout << ar << '\n';
        break;

        case 'c':
        cout << "Enter the height of the Triangle: ";
        cin >> h;
        cout << "Enter the base of the Triangle: ";
        cin >> b;
        ar = 0.5*b*h;
        cout << ar << '\n';
    }
    return 0;

}
