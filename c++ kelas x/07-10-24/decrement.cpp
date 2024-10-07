#include <iostream>
using namespace std;

int main() {
   /* int a;

    cout << "Limit?: ";
    cin >> a;

    cout << "Deretan angka ganjil dari 0 hingga " << a << " adalah:" << endl;
    if (a % 2 == 0) {
        a--;
    }


    for (int i = a; i > 0; i -= 2) {
        cout << i << " ";
    }

       cout << endl;

    cout << "Deretan angka genap dari 0 hingga " << a << " adalah:" << endl;

    for (int i = 0; i <= a; i += 2) {
        cout << i << " ";
    }
    cout<<endl;
    cout << "Deretan angka kelipatan 4 " << a << " adalah:" << endl;

    for (int i = 0; i <= a; i += 4) {
        cout << i << " ";
    }
    cout<<endl;

    cout << "Deretan angka ganjil rumus modulus " << a << " adalah:" << endl;

    for (int i=100; i > 0; i--) {
            if (i % 2== 1)
        cout << i << " ";
    }
    cout<<endl;

    cout << "Deretan angka genap rumus modulus " << a << " adalah:" << endl;

    for (int i = 100; i > 0; i--) {
            if (i % 2== 0)
        cout << i << " ";
   */


        int array [100];

      for (int i =20; i >0; --i){
            array[i] = i*5;
      }
        std::cout<< "cpp anjeng" <<std::endl;

      for (int i = 20; i>0; --i) {

        std::cout<< "array [" <<i<<"] = " <<array[i] << std::endl;
      }
    cout << endl;
    return 0;
}
