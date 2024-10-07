#include <iostream>


using namespace std;

int main() {
    int t;
    char l;

   // cout << "Masukkan tinggi segitiga: ";
   // cin >> t;
  //  cout <<"apa yang mau di susun?";
  //  cin>>l;


    for (int s = 1; s <= 10; s++) {

        for (int j = 1; j <= 10 - s; j++) {
            cout << " ";
        }//kiri

        for (int k = 1; k <= s; k++) {
            cout <<"*" ;
        }//kanan
        cout <<endl;
    }

    return 0;
}
