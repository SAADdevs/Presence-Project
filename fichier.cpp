#include <iostream>
#include "lifeforme.h"
#include "lifeforme.cc"
#include "shape.h"
#include "shape.cc"
#include <string>
#include "Simulation.h"
#include "Simulation.cpp"
#include "message.h"
#include "message.cc"
#include <fstream>
#include "constantes.h"
using namespace std;
int main()
{
    ifstream w("t00.txt");
    Simulation a;
    a.lecture(w);
    return 0;
}