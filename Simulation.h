#ifndef LIFEFORM_H
#define LIFEFORM_H
#include "shape.h"
#include <tuple>
#include <string>
#include "message.h"
#include "constantes.h"




class Simulation {
private:
    int nbr_cr;   
    int nbr_alg;  
    int nbr_scav; 

public:
    
    Simulation(int _nbr_cr, int _nbr_alg, int _nbr_scav);

    int getNbrCr() const;
    int getNbrAlg() const;
    int getNbrScav() const;
    void readFromFile(const std::string& filename);
    void setNbrCr(int _nbr_cr);
    void setNbrAlg(int _nbr_alg);
    void setNbrScav(int _nbr_scav);
};
