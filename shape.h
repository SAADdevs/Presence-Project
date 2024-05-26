#ifndef SHAPE_H
#define SHAPE_H

#include <cmath>
#include <iostream> // Pour std::cout

// Structure repr�sentant un point 2D
struct S2d {
    double x;
    double y;
};

// Structure repr�sentant un segment 2D
struct Segment {
    S2d start;
    S2d end;
    double length; // Longueur du segment
    double angle;  // Angle du segment
};

// Calcule le produit scalaire entre deux vecteurs
double produitScalaire(const Segment& s1, const Segment& s2);

// Calcule l'�cart angulaire entre deux segments
double ecartAngulaire(const Segment& s1, const Segment& s2);

// V�rifie si deux segments sont superpos�s
void superposition(const Segment& s1, const Segment& s2);

// Fonction qui v�rifie si un point r se trouve sur le segment p-q
bool onSegment(const S2d& p, const S2d& q, const S2d& r);

// Fonction qui calcule l'orientation de trois points (p, q, r)
int orientation(const S2d& p, const S2d& q, const S2d& r);

// Fonction qui v�rifie si deux segments se croisent
bool doIntersect(const S2d& p1, const S2d& q1, const S2d& p2, const S2d& q2);

#endif�//�SHAPE_H
